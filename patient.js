const express = require('express');
const router = express.Router();
const database = require('./database');
const authenticate = require('./authentication');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken'); 

router.get('/loginpatient', (request, response) => {
    response.render('userlogin');
});

router.post('/loginpatient', async (req, res) => {
    try {
        const [rows] = await database.query('SELECT * FROM patient WHERE SSN = ?', [req.body.SSN]);
        console.log('Rows:', rows); // Log the rows to the console

        const user = rows[0];

        if (!user) {
            return res.status(401).json({ error: 'Invalid SSN or password.' });
        }

        const valid = await bcrypt.compare(req.body.password, user.password);

        if (!valid) {
            return res.status(401).json({ error: 'Invalid SSN or password.' });
        }

        // Create a JWT token
        const token = jwt.sign(
            { id: user.id, roles: user.roles },
            process.env.JWT_SECRET || 'defaultSecret',
            { expiresIn: '15m' }
        );

        res.json({ ok: true, token: token });
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: 'Internal Server Error' });
    }
});


router.get("/", function (request, response, next) {
    var query = "SELECT * FROM patient";
    database.query(query, function (error, data) {
        if (error) {
            console.error(error);
        } else {
            response.render('patient', { title: 'RAYLENE PATIENTS', action: 'list', patientData: data });
        }
    });
});
router.get('/addpatient',function(request, response, next){
    response.render("patient", { title: " PATIENT", action: "add" })
})

router.post("/", function (request, response, next) {
    var firstname = request.body.Pfname;
    var lastname = request.body.Plname;
    var ssn = request.body.SSN;
    var gender = request.body.Gender;
    var address = request.body.Address;
    var yearofbirth = request.body.YearofBirth;
    var email = request.body.email;
    var password = request.body.password;

    var query = `INSERT INTO patient (Pfname, Plname, SSN, YearofBirth, Gender, Address, email, password)
                 VALUES ('${firstname}', '${lastname}', '${ssn}', '${yearofbirth}', '${gender}', '${address}', '${email}', '${password}')`;

    database.query(query, function (error, data) {
        if (error) {
            console.error(error);
            response.status(500).send("Error adding patient");
        } else {
            response.redirect("/patient/");
        }
    });
});


router.get("/editpatient/:SSN", function(request,response, next){
    const fetchSSN=request.params.SSN;
    var query="SELECT * FROM patient where SSN=?";
    database.query(query,fetchSSN,function(error,data){
        if (error){
            console.error(error);
        }else{
    
                response.render('patient', { title: 'EDIT PATIENT DETAILS', action: 'edit', patientData: data [0]});
        }
    });
});
router.post("/editpatient/:SSN", function(request,response, next){
    const fetchSSN=request.params.SSN;
    var firstname = request.body.Pfname;
    var lastname = request.body.Plname;
    var gender = request.body.Gender;
    var address = request.body.Address;
    var yearofbirth = request.body.YearofBirth;
    var email = request.body.email;
    

    var query=`UPDATE patient SET 
    Pfname = '${firstname}',
    Plname= '${lastname}',
    Gender= '${gender}',
    YearofBirth= '${yearofbirth}',
    Address= '${address}',
    email= '${email}' WHERE SSN ='${fetchSSN}'`;

        
    database.query(query, function (error, data) {
        if (error) {
            console.error(error);
            response.status(500).send("Error editing patient");
        } else {
            response.redirect("/admin/patient/");
        }
    });
    });

router.get("/fetchbySSN/:SSN", function (request, response, next) {
    const fetchSSN = request.params.SSN;
    var query = "SELECT * FROM patient where SSN=?";

    database.query(query, fetchSSN, function (error, data) {
        if (error) {
            console.error('Error fetching patient:', error);
            response.status(500).send("Internal Server Error");
        } else {

            response.render('patientBYSSN', { title: 'PATIENT', action: 'list', patientData: data });
        }
    });
});

router.get("/fetchbyGender/:Gender",  function (request, response, next) {
    const fetchGender = request.params.Gender;
    var query = "SELECT * FROM patient WHERE Gender=?";

    database.query(query, fetchGender, function (error, data) {
        if (error) {
            console.error(error);
        } else {
            response.render('patientByGender', { title: 'PATIENT', action: 'list', patientData: data });
        }
    });
});

router.get("/fetchPurchase/:SSN",  function (request, response, next) {
    const fetchSSN = request.params.SSN;

    var query = "SELECT * FROM sales WHERE SSN=?";

    database.query(query, fetchSSN, function (error, data) {
        if (error) {
            console.error(error);
        } else {
            response.render('purchaseBySSN', { title: 'PATIENT', action: 'list', salesData: data });
        }
    });
});

router.get("/fetchPurchase/:SSN/:TradeName",  function (request, response, next) {
    const fetchSSN = request.params.SSN;
    const fetchTradeName = request.params.TradeName;

    var query = "SELECT * FROM sales WHERE SSN=? AND Trade Name=?";

    database.query(query, [fetchSSN, fetchTradeName], function (error, data) {
        if (error) {
            console.error(error);
        } else {
            response.render('purchaseByTradeName', { title: 'PATIENT', action: 'list', salesData: data });
        }
    });
});

module.exports = router;
