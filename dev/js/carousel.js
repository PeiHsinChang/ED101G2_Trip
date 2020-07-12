window.onload = function () {
    //點開頁面就要load
    var xhr = new XMLHttpRequest();
    //發出ajax請求要資料
    xhr.onload = function () {
        if (xhr.status == 200) {
            //如果資料傳送成功
            carouselPackage = JSON.parse(xhr.responseText);
            console.log(carouselPackage);
            // console.log(carouselPackage[4]);
            GroupCarousel_As = carouselPackage[0];
            GroupCarousel_Bs = carouselPackage[1];
            GroupCarousel_Cs = carouselPackage[2];
            GroupCarousel_Ds = carouselPackage[3];
            GroupCarousel_Es = carouselPackage[4];
            // // $id('GroupCarousel_deskA').innerHTML = carouselPackage[0];

            new Vue({
                el: '#GroupCarousel_deskA',
                data: {
                    GroupCarousel_As,
                },
                computed: {

                },
            });
            new Vue({
                el: '#GroupCarousel_deskB',
                data: {
                    GroupCarousel_Bs,
                },
                computed: {

                },
            });
            new Vue({
                el: '#GroupCarousel_deskC',
                data: {
                    GroupCarousel_Cs,
                },
                computed: {

                },
            });
            new Vue({
                el: '#GroupCarousel_deskD',
                data: {
                    GroupCarousel_Ds,
                },
                computed: {},
            });
            new Vue({
                el: '#GroupCarousel_deskE',
                data: {
                    GroupCarousel_Es,
                },
                computed: {

                },
            });
        } else {
            alert(xhr.status);
            //如果資料傳送失敗的話顯示原因
        }
    };
    xhr.open("post", "group_carousel.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send(); //因為開太快所以要送個空值回去
};