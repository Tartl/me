function calc(){
    var number1 = parseInt(document.getElementById("number1").value);
    var number2 = parseInt(document.getElementById("number2").value);
    var operand = document.getElementById("operand").value;
    var result = 0;
    switch (operand) {
        case "+":
        {
            result = number1 + number2;
            break;
        }
        case "-":  
        {
            result = number1 - number2;
            break;
        }
        case "*":
        {
            result = number1 * number2;
            break;
        }
        case "/":
        {
            if(number2 != 0)
                result = number1 / number2;
            else console.log("Dividing by zero!");
            break;
        }
    }
    console.log(result);
    document.getElementById("result").textContent = result;
}