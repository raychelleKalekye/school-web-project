const express = require('express');
const router = express.Router();
var database = require('./database');
const multer = require('multer');

const storage = multer.memoryStorage();
const upload = multer({ storage: storage });

router.get("/", function (request, response, next) {
    var query = "SELECT * FROM drugs";
    database.query(query, function (error, data) {
        if (error) {
            console.error('Error retrieving drugs:', error);
            response.status(500).send("Internal Server Error");
        } else {
            data.forEach(function (item) {
               
                if (item.drg_img) {
                    item.drg_img = Buffer.from(item.drg_img).toString('base64');
                }
                  
            });

            response.render('drugsdata', { title: 'DRUGS', action: 'list', drugsData: data });
        }
    });
});
router.get("/editdrug/:TradeName", function(request,response, next){
    const fetchTradeName = request.params.TradeName;
    

    var query="SELECT * FROM drugs where TradeName=?";
    database.query(query,fetchTradeName,function(error,data){
        if (error){
            console.error(error);
        }else{
    
                response.render('drugsdata', { title: 'EDIT DRUG DETAILS', action: 'edit', drugsData: data [0]});
        }
    });
});
router.post("/editdrug/:TradeName",  upload.single('drg_img'),function(request,response, next){
    var tradename = request.body.TradeName;
    var formula = request.body.Formula;
    var Category = request.body.Category;
    var drgimage = request.file ? request.file.buffer.toString('base64') : null;

    

    var query=`UPDATE drugs SET 
    Formula = '${formula}',
    Category= '${Category}',
    drg_img= '${drgimage}' WHERE TradeName ='${tradename}'`;
    

        
    database.query(query, function (error, data) {
        if (error) {
            console.error(error);
            response.status(500).send("Error editing drug");
        } else {
            response.redirect("/drugsdata/");
        }
    });
    });
   


router.get("/fetchbyCategory/:Category", function (request, response, next) {
    const fetchCategory = request.params.Category;
    var query = "SELECT * FROM drugs where Category=?";

    database.query(query, fetchCategory, function (error, data) {
        if (error) {
            console.error('Error fetching drugs by category:', error);
            response.status(500).send("Internal Server Error");
        } else {
            data.forEach(function (item) {
                if (item.drg_img) {
                    item.drg_img = Buffer.from(item.drg_img).toString('base64');
                }
            });

            response.render('drugsByCategory', { title: 'DRUGS', action: 'list', drugsData: data });
        }
    });
});

router.get("/fetchbyTradeName/:TradeName", function (request, response, next) {
    const fetchTradeName = request.params.TradeName;
    var query = "SELECT * FROM drugs where TradeName=?";

    database.query(query, fetchTradeName, function (error, data) {
        if (error) {
            console.error('Error fetching drugs by trade name:', error);
            response.status(500).send("Internal Server Error");
        } else {
            data.forEach(function (item) {
                if (item.drg_img) {
                    item.drg_img = Buffer.from(item.drg_img).toString('base64');
                }
            });

            response.render('drugsByTradeName', { title: 'DRUGS', action: 'list', drugsData: data });
        }
    });
});

router.get("/add_drug", function (request, response, next) {
    response.render("drugsdata", { title: " DRUGS", action: "add" });
});

router.post("/", upload.single('drg_img'), function (request, response, next) {
    var tradename = request.body.TradeName;
    var formula = request.body.Formula;
    var Category = request.body.Category;
    var drgimage = request.file.buffer.toString('base64');

    var query = `INSERT INTO drugs (TradeName,Formula,Category,drg_img)
                 VALUES ('${tradename}', '${formula}', '${Category}', '${drgimage}')`;

   

    database.query(query, function (error, data) {
        if (error) {
            console.error('Error adding drug:', error);
           alert("Error: ". $error.getMessage());
            response.status(500).send("Error adding drug");
        } else {
        
            response.redirect("/drugsdata/");
        }
    });
});

router.get("/deletedrug/:TradeName", function(request,response, next){
    const fetchTradeName = request.params.TradeName;
    

   var query=`DELETE FROM drugs WHERE TradeName="${fetchTradeName}"`;
    database.query(query,fetchTradeName,function(error,data){
        if (error){
            console.error(error);
        }else{
    
           response.redirect("/drugsdata/");
        }
    });
});
module.exports = router;
