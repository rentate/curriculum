
function createJuice(fruits){
    console.log(fruits+"を受け取りました。ジュースにして返します");
    return fruits+"ジュース";
}

let juice = createJuice("りんご");
console.log(juice+"が届きました");