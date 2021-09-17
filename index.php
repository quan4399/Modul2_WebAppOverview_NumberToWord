<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chuyển đổi số sang chữ</title>

    <style>
        input[type=number] {
            width: 300px;
            font-size: 16px;
            border: 2px solid #ccc;
            border-radius: 10px;
            padding: 12px 10px 12px 10px;

        }

        #submit {
            border-radius: 10px;
            padding: 10px 32px;
            font-size: 16px;
        }
    </style>
</head>
<body>
<form method="POST">
    <h2>Application: Speak Number to Word</h2>
    <input type="number" name="number" placeholder="Enter Number">
    <input type="submit" id="submit" value="Speak">
</form>
</body>
</html>
<?php
function convert_1_digit($number)
    {
        $unit = ["zero", "one", "two", "three", "four" , "five", "six", "seven", "eight", "nine", "ten"];
        return $unit[$number];
    }

function convert_2_digit($number)
    {
        $lessthan20 = [10 => "ten", 11 => "eleven", 12 => "twelve" ,
                       13 => "thirteen", 14 => "fourteen", 15 => "fifteen",
                        16 => "sixteen", 17 => "seventeen", 18 => "eighteen", 19 => "nineteen"];
        $tens = [2 => "twenty", 3 => "thirty", 4 => "forty", 5 => "fifty", 6 => "sixty", 7 => "seventy", 8 => "eighty", 9 => "ninety" ];

        if ($number < 20)
        {
            return $lessthan20[$number];
        }
        if ($number[1] == 0 )
        {
            return $tens[$number[0]];
        }
        return $tens[$number[0]] . " " .convert_1_digit($number[1]);
    }

function convert_3_digit($number)
    {
        if ($number % 100 == 0)
        {
            return convert_1_digit($number[0]) . " hundred ";
        }
        if ($number[1] == 0 )
        {
            return convert_1_digit($number[0]) . " hundred " . convert_1_digit($number[2]);
        }
        return convert_1_digit($number[0]) . " hundred " . convert_2_digit(substr($number,1, 2));
    }
function convert_words($number)
{
    switch (strlen($number)) {
        case 1:
            $words = convert_1_digit($number);
            break;
        case 2:
            $words = convert_2_digit($number);
            break;
        case 3:
            $words = convert_3_digit($number);
            break;
        default:
            $words = 'OUT OF ABILITY';
            break;
    }
    return $words;
}

?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $number = $_POST["number"];
    echo convert_words($number);
}
