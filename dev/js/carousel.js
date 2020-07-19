window.onload = function() {
    titleCarousel();
    hotSche();
    groupCard();
    group_carousel();

    // SortByLike();


}

function titleCarousel() {
    //點開頁面就要load
    var xhr = new XMLHttpRequest();
    //發出ajax請求要資料
    xhr.onload = function() {
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

function hotSche() {
    //點開頁面就要load
    var xhr = new XMLHttpRequest();
    //發出ajax請求要資料
    xhr.onload = function() {
        if (xhr.status == 200) {
            //如果資料傳送成功
            hotSchePackage = JSON.parse(xhr.responseText);
            // console.log(hotSchePackage);
            // console.log(hotSchePackage[4]);
            hotSche001 = hotSchePackage[0];
            hotSche002 = hotSchePackage[1];
            hotSche003 = hotSchePackage[2];
            new Vue({
                el: '#hotSche001',
                data: {
                    hotSche001,
                },
                computed: {

                },
            });
            new Vue({
                el: '#hotSche002',
                data: {
                    hotSche002,
                },
                computed: {

                },
            });
            new Vue({
                el: '#hotSche003',
                data: {
                    hotSche003,
                },
                computed: {

                },
            });





        } else {
            alert(xhr.status);
            //如果資料傳送失敗的話顯示原因
        }
    };
    xhr.open("post", "groupViewHotSche.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send(); //因為開太快所以要送個空值回去
};


function groupCard() {
    let xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (xhr.status == 200) {

            //desktop version
            groupviewCards = JSON.parse(xhr.responseText);
            console.log(groupviewCards[0]);
            groupCardsAlls = groupviewCards[0];

            new Vue({
                el: '#groupCardsAll',
                data: {
                    groupCardsAlls,
                },
                methods: {
                    SortByLike: groupCardsAlls.sort(function(a, b) {
                        return b.hostlike - a.hostlike;
                    }),
                    sortByLatest: groupCardsAlls.sort(function(a, b) {
                        return a.Group_NO - b.Group_NO;
                    }),

                },


            });

        } else {
            alert(xhr.status);
        }
    };
    xhr.open("post", "groupCard.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send();
};


function group_carousel() {
    let xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (xhr.status == 200) {
            //mobile carousel
            groupCarousel = JSON.parse(xhr.responseText);
            console.log(groupCarousel);
            groupCardCarousel_1 = groupCarousel[0];
            groupCardCarousel_2 = groupCarousel[1];
            groupCardCarousel_3 = groupCarousel[2];
            groupCardCarousel_4 = groupCarousel[3];
            groupCardCarousel_5 = groupCarousel[4];

            new Vue({
                el: '#groupCardCarousel_1',
                data: {
                    groupCardCarousel_1,
                },
            });

            new Vue({
                el: '#groupCardCarousel_2',
                data: {
                    groupCardCarousel_2,
                },
            });

            new Vue({
                el: '#groupCardCarousel_3',
                data: {
                    groupCardCarousel_3,
                },
            });

            new Vue({
                el: '#groupCardCarousel_4',
                data: {
                    groupCardCarousel_4,
                },
            });

            new Vue({
                el: '#groupCardCarousel_5',
                data: {
                    groupCardCarousel_5,
                },
            });


        } else {
            alert(xhr.status);
        }
    };
    xhr.open("post", "group_carousel.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send();
};


// function SortByLike() {
//     let xhr = new XMLHttpRequest();
//     xhr.onload = function() {
//         if (xhr.status == 200) {

//             //desktop version
//             groupviewSortLike = JSON.parse(xhr.responseText);
//             console.log(groupviewSortLike[0]);
//             groupSortLike = groupviewSortLike[0];

//             new Vue({
//                 el: '#groupCardsAll',
//                 data: {
//                     groupSortLike,
//                 },
//                 // methods: {
//                 //     function() {
//                 //         return this.groupSortLike;
//                 //     }
//                 // },
//             });

//         } else {
//             alert(xhr.status);
//         }
//     };
//     xhr.open("post", "groupSortByLike.php", true);
//     xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
//     xhr.send();
// };