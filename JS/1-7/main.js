class Human {
    constructor(name, age){
        this.name = name;
        this.age = age;
    }
}

let yamada = new Human('yamada', 20);
// console.log(yamada.name);

class Taiyaki {
    constructor(content){
        this.content = content;
        console.log("中身は" + this.content + "です")
    }
}

let anko = new Taiyaki('あんこ');

let cream = new Taiyaki('クリーム');

let cheese = new Taiyaki('チーズ');

// console.log("中身は" + anko.content + "です");
// console.log("中身は" + cream.content + "です");
// console.log("中身は" + cheese.content + "です");


