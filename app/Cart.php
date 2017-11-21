<?php

namespace App;



class Cart
{
    public $items;
    public $totalQty=0;
    public $totalPrice=0;

    public function __construct($oldCart)
    {
        if($oldCart){
            $this->items=$oldCart->items;
            $this->totalQty=$oldCart->totalQty;
            $this->totalPrice=$oldCart->totalPrice;
        }else{
            $this->items=null;
        }
    }

    public function Add($pd,$id){
        $storeItem = ['qty'=>0,'amount'=>$pd->price,'pd'=>$pd];
        if($this->items){
            if(array_key_exists($id,$this->items)){
                $storeItem = $this->items[$id];
            }
        }
        $storeItem['qty']++;
        $storeItem['amount']=$storeItem['qty'] * $pd->price;
        $this->items[$id]=$storeItem;
        $this->totalQty++;
        $this->totalPrice += $pd->price;
    }

    public function decrease($id){
        $this->items[$id]['qty']--;
        $this->items[$id]['amount'] -= $this->items[$id]['pd']['price'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['pd']['price'];
        if($this->items[$id]['qty'] <= 0){
            unset($this->items[$id]);
        }

    }

    public function increase($id){
        $this->items[$id]['qty']++;
        $this->items[$id]['amount']+= $this->items[$id]['pd']['price'];
        $this->totalQty++;
        $this->totalPrice += $this->items[$id]['pd']['price'];

    }
}
