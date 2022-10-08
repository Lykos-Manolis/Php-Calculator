function AddToScreen(newInput){
    const symbols = ["/","*","+","-"]

    form = document.getElementById("form");
    screen = document.getElementById("screenText");
    num1Field = document.getElementById("num1");
    symbolField = document.getElementById("symbol");
    temp = document.getElementById("temp");

    if(num1Field.value=="Cannot divide by zero")
    {
        ClearForm()
    }

    if (newInput >= 0 && newInput <=9)
    {
        screen.value+=newInput;
    }
    else if(num1Field.value=='' && screen.value=='')
    {
        return;
    }
    else if ((symbolField.value=='' || screen.value=='') && symbols.includes(newInput))
    {
        symbolField.value=newInput;
        if(screen.value!='')
        {
            num1Field.value=screen.value;
            screen.value='';
        }
    }
    else if(newInput=='.')
    {
        screen.value+=newInput;
    }
    else{
        temp.value=newInput;
        form.submit();
    }
}

function ClearForm(){
    document.getElementById("screenText").value = "";
    document.getElementById("num1").value = "";
    document.getElementById("symbol").value = "";
    document.getElementById("temp").value = "";
}

function SubmitForm(){
    document.getElementById("form").submit();
}

function SpecialCharacter(character){
    form = document.getElementById("form");
    num1Field = document.getElementById("num1");
    screen = document.getElementById("screenText");
    symbolField = document.getElementById("symbol");
    specialField = document.getElementById("special");

    if(screen.value!="" && num1Field.value=="" && symbolField.value=="")
    {
        specialField.value=character;
        form.submit();
    }
}

function Backspace(){
    screen = document.getElementById("screenText");

    if(screen.value != "")
    {
        screen.value = screen.value.slice(0,-1);
    }
}

function ClearScreen(){
    document.getElementById("screenText").value = "";
}

function RandomNumber(){
    document.getElementById("screenText").value = Math.round(Math.random() * (1000000))
}

function MoveScientificPanel(){
    panel = document.getElementById("scientificPanel");
    button = document.getElementById("scientificButton");

    if(panel.style.marginRight == ""){
        panel.style.marginRight = "505px";
        panel.style.filter = "drop-shadow(3px 3px 0 var(--panel-shadow))";
        button.style.left = "-30px";
        button.style.color = "white";
    }
    else if(panel.style.marginRight == "505px"){
        panel.style.marginRight = "";
        panel.style.filter = "";
        button.style.left = "";
        button.style.color = "";
    }
}