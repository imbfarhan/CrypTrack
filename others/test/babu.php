<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin:0;
            padding:0;
        }

        .test{
            background-color:grey;
            width:80%;
        }

    </style>
</head>
<body>
    <h1>
        Hello World
    </h1>
    <div class="test">
        <?php   
            $age = 10;
                if($age<20){
                    echo "Your age is below 20";
                }
                else{
                    echo "Your age is $age";
                }

                $test=array(1,2,3,4);
                $a=0;
                while($a < count($test))
                {
                    echo"<br>";
                    echo $test[$a] ;
                    $a++;
                }

                $a=0;
                foreach($test as $val){
                    echo "$val <br>";
                }
                five();

                function five(){
                    echo "Five"."Noy";
                }

                $name="Farhan";
                echo"<br>Name:".$name;
                echo "<br>String length:".strlen($name)."<br>";
                echo "String reversed:".strrev($name)."<br>";
                echo "String ha:".strpos($name,"ar")."<br>";
                echo "String reversed:".str_replace("an","aa",$name)."<br>";
        ?>
    </div>
</body>
</html>