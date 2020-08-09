// 問1
let numbers = [2, 5, 12, 13, 15, 18, 22];
//ここに答えを実装してください。↓↓↓
function isEven(num) {
    for(i=0;i<num.length;i++){
        if(num[i] % 2 === 0){
            console.log(num[i] + 'は偶数です');
        }
    }
}
isEven(numbers);

// 問２
class Car {
    constructor(gas, num){
        this.gas = gas;
        this.num = num;
        getNumGas(this.gas, this.num);
    }
}

function getNumGas(gas, num){
    console.log("ガソリンは" + gas + "です。ナンバーは" + num + "です");
}

let car = new Car(100, 9876);