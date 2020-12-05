
<style> #number, #account, #amount {display: none} 
        form     {margin: auto; border: 3px solid red; padding: 20px; width: 500px;}
</style>


<form action = "service2.php">
    <input type="radio" name="c" value="list" id="same" onclick="num()" >List accounts and transactions <br>

    <input type="radio" name="c" value="perform" id="same" onclick="acc()">Perform transactions <br>

    <input type="radio"  name="c"  value="clear" id="same" onclick="amo()">Clear <br><br>

    <div id="number"> Enter number of transactions to be displayed: <input type='text' name="number" value=""><br></div>

    <div id="account"> Enter a negative amount to withdraw.<br><br>Enter account: <input type='text' name="account" value=""><br>   </div>

    <div id= "amount"> Enter amount:<input type=text name="amount" value="">  <br><br></div><br><br> 

    <input type = submit>
</form>

<script>
    var ptrNumber =  document.getElementById("number");
    var ptrAccount =  document.getElementById("account");
    var ptrAmount =  document.getElementById("amount");

function num() {  
    ptrNumber.style.display = "block";
    ptrAccount.style.display = "none";
    ptrAmount.style.display = "none";
}
function acc() {
    ///

    ptrNumber.style.display = "none";
    ptrAmount.style.display = "block";
    ptrAccount.style.display = "block";
}

function amo() {
    ptrNumber.style.display = "none";
    ptrAccount.style.display = "block";
    ptrAmount.style.display = "none";
}

</script>