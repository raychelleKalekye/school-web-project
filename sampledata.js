const express = require('express');
const router = express.Router();
var database = require('./database');



router.get("/add",function(request,response,next){
    response.render("sampledata",{title:"INSERT PATIENT",action: "add"});
})
module.exports=router;