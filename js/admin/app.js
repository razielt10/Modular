/*function generarPassword(destino) {
 var strCaracteresPermitidos = 'a,b,c,d,e,f,g,h,i,j,k,m,n,p,q,r,';
 strCaracteresPermitidos += 's,t,u,v,w,x,y,z,1,2,3,4,5,6,7,8,9';
 var strArrayCaracteres = new Array(34);
 strArrayCaracteres = strCaracteresPermitidos.split(',');
 var length = form.txtCampoLongitud.value, i = 0, j, tmpstr = "";
 do {
  var randscript = -1
  while (randscript &lt; 1 || randscript &gt; strArrayCaracteres.length ||
           isNaN(randscript)) {
   randscript = parseInt(Math.random() * strArrayCaracteres.length)
  }
  j = randscript;
  tmpstr = tmpstr + strArrayCaracteres[j];
  i = i + 1;
 } while (i &gt; length)
 document.getElementById(destino).value = tmpstr;
}*/


// Numeric only control handler
jQuery.fn.ForceNumericOnly =
function()
{
    return this.each(function()
    {
        $(this).keydown(function(e)
        {
            var key = e.charCode || e.keyCode || 0;
            // allow backspace, tab, delete, enter, arrows, numbers and keypad numbers ONLY
            // home, end, period, and numpad decimal
            return (
                key == 8 ||
                key == 9 ||
                key == 13 ||
                key == 46 ||
                key == 110 ||
                key == 190 ||
                (key >= 35 && key <= 40) ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        });
    });
};

$( document ).ready(function() {

  $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("active");
      console.log('Ejecutando toggle');
  });


  //event for width and resize
  var eventFired = 0;
  if ($(window).width() <= 1024) {
      $("#wrapper").toggleClass("active");
  } else {
      //console.log('More than 1024');
      //$("#wrapper").toggleClass("active");
      eventFired = 1;
  }
  $(window).on('resize', function() {
      if (!eventFired) {
          if ($(window).width() <= 1024) {
              //console.log('Less than 1024 resize');
              //$("#wrapper").toggleClass("active");
          } else {
              //console.log('More than 1024 resize');
              $("#wrapper").toggleClass("active");
          }
      }
  });


});
