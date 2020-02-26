 ///<reference path="../../node_modules/@types/jquery/index.d.ts"/>
 class Test {
    public draw() {
        let x = $('.testSpan');
        x.css('color', 'blue');
    }
 }

 let test = new Test();
 $( document ).ready(function() {

    $( "#sub" ).click(function() {
        setInterval(test.draw, 2000);
    });
});
