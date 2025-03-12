document.addEventListener("DOMContentLoaded", function() {

    /* eslint-disable */

    const cartNav = document.querySelector('#navCartBtn');
    const cartCountContainer = document.querySelector('#wccartcount');
    const cartTotalContainer = document.querySelector('#wccarttotal');
    




/* eslint-disable */
jQuery(document.body).on('added_to_cart', function(){

    cartNav.classList.toggle('--active', true);
    console.log("ADD TO CART EVENT");
    var data = {
        "action": "get_cart_count"
    }


    fetch(wc_cart_params.ajax_url, {
        method: "POST",
        credentials: 'same-origin',
        headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'Cache-Control': 'no-cache',
        },
        body:  new URLSearchParams(data)
    })
    .then(function(response){ 
        console.log("response", response);
        return response.json(); 
    })
    .then(function(data){ 
        cartCountContainer.innerHTML = data[0];
        cartTotalContainer.innerHTML = data[1];
        console.log("D", data);

    });
});

});
/* eslint-enable */