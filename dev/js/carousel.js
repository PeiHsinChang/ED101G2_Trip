window.onload = function () {
    //點開頁面就要load
    var xhr = new XMLHttpRequest();
    //發出ajax請求要資料
    xhr.onload = function () {
        if (xhr.status == 200) {
            //如果資料傳送成功
            carouselPackage = JSON.parse(xhr.responseText);
            // console.log(carouselPackage);
            // console.log(carouselPackage[4]);

            //桌機版輪播
            GroupCarousel_As = carouselPackage[0];
            GroupCarousel_Bs = carouselPackage[1];
            GroupCarousel_Cs = carouselPackage[2];
            GroupCarousel_Ds = carouselPackage[3];
            GroupCarousel_Es = carouselPackage[4];

            //手機版輪播
            GroupCarousel_Fs = carouselPackage[0];
            GroupCarousel_Gs = carouselPackage[1];
            GroupCarousel_Hs = carouselPackage[2];
            GroupCarousel_Is = carouselPackage[3];
            GroupCarousel_Js = carouselPackage[4];


            // // $id('GroupCarousel_deskA').innerHTML = carouselPackage[0];
            //桌機版輪播
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

            //手機版輪播
            new Vue({
                el: '#GroupCarousel_deskF',
                data: {
                    GroupCarousel_Fs,
                },
                computed: {

                },
            });
            new Vue({
                el: '#GroupCarousel_deskG',
                data: {
                    GroupCarousel_Gs,
                },
                computed: {

                },
            });
            new Vue({
                el: '#GroupCarousel_deskH',
                data: {
                    GroupCarousel_Hs,
                },
                computed: {

                },
            });
            new Vue({
                el: '#GroupCarousel_deskI',
                data: {
                    GroupCarousel_Is,
                },
                computed: {},
            });
            new Vue({
                el: '#GroupCarousel_deskJ',
                data: {
                    GroupCarousel_Js,
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