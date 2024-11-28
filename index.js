const express = require("express");
const {VM} = require("vm2");

const app = express();
const vm = new VM();

app.use(express.json());



app.get('/', function (req, res) {
    return res.send("Hello, just index : )");
});

app.post('/calc',async function (req, res) {
    let { eqn } = req.body;
    if (!eqn) {
        return res.status(400).json({ 'Error': 'Please provide the equation' });
    } 
    else if (eqn.match(/[a-zA-Z]/)) {
        return res.status(400).json({ 'Error': 'Invalid Format' });
    }

    try {
        result = await vm.run(eqn);
        res.send(200,result);
    } catch (e) {
        console.log(e);
        return res.status(400).json({ 'Error': 'Syntax error, please check your equation' });
    }
});



app.listen(3000,'0.0.0.0',function(){
    console.log("Started !")
});

