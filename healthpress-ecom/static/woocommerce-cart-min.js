document.addEventListener("DOMContentLoaded",(function(){const e=document.querySelector("#navCartBtn"),n=document.querySelector("#wccartcount"),o=document.querySelector("#wccarttotal");jQuery(document.body).on("added_to_cart",(function(){e.classList.toggle("--active",!0),console.log("ADD TO CART EVENT");fetch(wc_cart_params.ajax_url,{method:"POST",credentials:"same-origin",headers:{"Content-Type":"application/x-www-form-urlencoded","Cache-Control":"no-cache"},body:new URLSearchParams({action:"get_cart_count"})}).then((function(e){return console.log("response",e),e.json()})).then((function(e){n.innerHTML=e[0],o.innerHTML=e[1],console.log("D",e)}))}))}));