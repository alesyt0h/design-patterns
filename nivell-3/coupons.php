<?php

class CouponGenerator {

    static $discount = 0;
    static $isHighSeason = false;
    static $bigStock = true;

    private $strategy;

    public function __construct(CarCouponGenerator $car){
        $this->strategy = $car;
    }

    public function setCarBrand(CarCouponGenerator $car){
        $this->strategy = $car;
    }

    public function generateCoupon(){
        $coupon = $this->strategy->generateCoupon();
        echo "Get {$coupon}% off the price of your new car.";
    }

}

interface CarCouponGenerator {
    public function generateCoupon(): int|float;
}

class BmwCouponGenerator implements CarCouponGenerator {

    public function generateCoupon(): int|float {
        $discount = CouponGenerator::$discount;

        $discount += $this->addSeasonDiscount();
        $discount += $this->addStockDiscount();

        return $discount;
    }

    public function addSeasonDiscount(){
        return (!CouponGenerator::$isHighSeason) ? 5 : 0;
    }

    public function addStockDiscount(){
        return (CouponGenerator::$bigStock) ? 7 : 0;
    }

} 

class MercedesCouponGenerator implements CarCouponGenerator {
    
    public function generateCoupon(): int|float {
        $discount = CouponGenerator::$discount;

        $discount += $this->addSeasonDiscount();
        $discount += $this->addStockDiscount();

        return $discount;
    }

    public function addSeasonDiscount(){
        return (!CouponGenerator::$isHighSeason) ? 4 : 0;
    }

    public function addStockDiscount(){
        return (CouponGenerator::$bigStock) ? 10 : 0;
    }

}

$couponGenerator = new CouponGenerator(new BmwCouponGenerator());
echo "For BMW Car: ";
$couponGenerator->generateCoupon();

echo "\r\n";

$couponGenerator->setCarBrand(new MercedesCouponGenerator());
echo "For Mercedes Car: ";
$couponGenerator->generateCoupon();

?>