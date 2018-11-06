
<h1>Prime Number</h1>

<?php $totalValue = isset($_POST["total"])? $_POST["total"] : ""?>

<form method="post">
    <input type="text" name="total" required value="<?=$totalValue?>">
    <input type="submit" name="submit">
</form>
<?php
//prime numbers
function find_primes($finish) {
 
 // Initialise the range of numbers.
 $number = 2;
 $range = range(2, $finish);
 $primes = array_combine($range, $range);

 // Loop through the numbers and remove the multiples from the primes array.
 while ($number*$number < $finish) {
   for ($i = $number; $i <= $finish; $i += $number) {
     if ($i == $number) {
       continue;
     }
     unset($primes[$i]);
   }
   $number = next($primes);
 }
 return $primes;
}



function check($num)
{
    for ($i = 2; $i < $num; $i++)
    {
        if ($num % $i == 0) 
        {
            return false;

        }

    }
    return true;           
}       
if(isset($_POST['submit'])){
    $total = $_POST["total"];
    $primeNumbers = [];
    $finalPrime = "";
    $number = 2 ;
    $primeNumbers = find_primes($total);
    //rearrange prime numbers
    array_splice($primeNumbers, 0, 0);  


    $array = $primeNumbers;
    $largest = [];
    $totalSum = [];
    
    $totalPrime = count($primeNumbers);
    //calcaulte the sum of all the prime numbers

    for($j=0;$j<=count($primeNumbers);$j++){
        $sum = 0;
        $html = "";
        $count = $totalPrime - $j;
        for($k=0;$k<$count;$k++){
            $sum += $array[$k];
            $html .= $array[$k] ;
            $check = check($sum);
            $html .=  " + ";
            //check the sum is prime number and less the submited total
            if($check && $sum < $total ){
                $largest[] = $k;
                $totalSum[$k]['sum'] = $sum;
                $totalSum[$k]['html'] = $html;
                
            }
        }
        unset($array[0]);
        array_splice($array, 0, 0);
    }

    $finalOutput = $totalSum[max($largest)];

    echo 'Final Output: '.substr($finalOutput['html'], 0, -2) . ' = '. $finalOutput['sum'];
    

}   