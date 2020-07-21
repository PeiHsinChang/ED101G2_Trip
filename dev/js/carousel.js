window.onload = function () {
    titleCarousel();
    hotSche();
    groupCard();
    group_carousel();
    groupShow();


}

function titleCarousel() {
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
    xhr.open("post", "groupViewCarousel2.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send(); //因為開太快所以要送個空值回去
};

function hotSche() {
    //點開頁面就要load
    var xhr = new XMLHttpRequest();
    //發出ajax請求要資料
    xhr.onload = function () {
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
    xhr.onload = function () {
        if (xhr.status == 200) {

            //desktop version
            var groupviewCards = JSON.parse(xhr.responseText);
            console.log(groupviewCards[0]);
            groupCardsAlls = groupviewCards[0];

            groupCardsAllsVue = new Vue({
                el: '#groupCardsAll',
                data: {
                    groupCardsAlls,
                },
                // methods: {
                //     SortByLike: groupCardsAlls.sort(function(a, b) {
                //         return b.hostlike - a.hostlike;
                //     }),

                //     sortByLatest: groupCardsAlls.sort(function(a, b) {
                //         return a.Group_NO - b.Group_NO;
                //     }),

                // },

            });
            // $('#search_text').change(function () {
            //     word = $("#search_text").val();
            //     console.log(word);
            // })

        } else {
            alert(xhr.status);
        }
    };
    xhr.open("post", "groupCard.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send(null);
};

// $('#search_text').change(function () {
//     word = $("#search_text").val();
//     console.log(word);
// })


function SortByLike() {

    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {

            //desktop version
            var groupviewSortLike = JSON.parse(xhr.responseText);
            console.log(groupviewSortLike[0]);
            groupSortLike = groupviewSortLike[0];
            groupCardsAllsVue.$data.groupCardsAlls = groupSortLike;

        } else {
            alert(xhr.status);
        }
    };
    xhr.open("post", "groupSortByLike.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send();


};

function sortByLatest() {
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {

            //desktop version
            var groupviewSortLatest = JSON.parse(xhr.responseText);
            console.log(groupviewSortLatest[0]);
            groupSortLatest = groupviewSortLatest[0];
            groupCardsAllsVue.$data.groupCardsAlls = groupSortLatest;

        } else {
            alert(xhr.status);
        }
    };
    xhr.open("post", "groupSortByLatest.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send();
}


function groupShow() {
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {

            //desktop version
            var groupShowCards = JSON.parse(xhr.responseText);
            console.log(groupShowCards[0]);
            groupShowAlls = groupShowCards;
            // groupShowAlls_1 = groupShowCards[0];


            new Vue({
                el: '#groupShowAlls_1',
                data: {
                    groupShowAlls_1,
                },
            });


            new Vue({
                el: '#groupShowAll',
                data: {
                    groupShowAlls,
                },


                // methods: {
                //     SortByLike: groupCardsAlls.sort(function(a, b) {
                //         return b.hostlike - a.hostlike;
                //     }),

                //     sortByLatest: groupCardsAlls.sort(function(a, b) {
                //         return a.Group_NO - b.Group_NO;
                //     }),

                // },

            });

        } else {
            alert(xhr.status);
        }
    };
    xhr.open("post", "groupShow.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send();
};

$("#groupSearch").click(function () {
    //按好什麼按鈕觸發事件
    console.log($("#search_text").val())
    //input內容有沒有進去網頁
    let xhr = new XMLHttpRequest();
    //跟後端要資料
    xhr.onload = function () {
        if (xhr.status == 200) {
            let searchResult = JSON.parse(xhr.responseText);
            console.log(searchResult);
            //檢查搜尋內容有沒有進網頁
            groupCardsAllsVue.$data.groupCardsAlls = searchResult;
            // 原本的資料名稱＋$data+後面引入的新搜尋資料
        } else {
            alert(xhr.status);
        }
    }

    xhr.open("post", "groupSearch.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    let data_info = `search_text=${$("#search_text").val()}`;
    // 把搜尋內容丟到後端
    xhr.send(data_info);
});


$("#btnGroupFilter").click(function () {
    //按好什麼按鈕觸發事件
    console.log($('#groupView_FliterPpl :selected').val());
    console.log($('#groupView_FliterSex :selected').val());
    console.log($('#groupView_FliterDay :selected').val());
    console.log($('#groupView_FliterMonth :selected').val());
    //check if the selector value are sent
    let xhr = new XMLHttpRequest();
    //跟後端要資料
    xhr.onload = function () {
        if (xhr.status == 200) { //當連線成功
            let filterResult = JSON.parse(xhr.responseText);
            console.log(filterResult);
            //檢查搜尋內容有沒有進網頁
            groupCardsAllsVue.$data.groupCardsAlls = filterResult;
            // 原本的資料名稱＋$data+後面引入的新搜尋資料
        } else {
            alert(xhr.status);
        }
    }

    xhr.open("post", "groupViewFilter.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    let data_info = `filter=${$("#groupView_FliterPpl :selected").val()} ${$("#groupView_FliterSex :selected").val()} ${$("#groupView_FliterDay :selected").val()} ${$("#groupView_FliterMonth :selected").val()}`;
    // 把搜尋內容丟到後端
    // 指令串接
    console.log(data_info); //檢查送出的指令
    xhr.send(data_info);
});

$("#btnPhoneFilter").click(function () {
    //按好什麼按鈕觸發事件
    console.log($('input[name=groupView_FliterPpl_phone]:checked').val());
    console.log($('input[name=groupView_FliterSex_phone]:checked').val());
    console.log($('input[name=groupView_FliterDay_phone]:checked').val());
    console.log($('input[name=groupView_FliterMonth_phone]:checked').val());
    //check if the selector value are sent
    let xhr = new XMLHttpRequest();
    //跟後端要資料
    xhr.onload = function () {
        if (xhr.status == 200) { //當連線成功
            let phoneFilterResult = JSON.parse(xhr.responseText);
            console.log(phoneFilterResult);
            //檢查搜尋內容有沒有進網頁
            groupCardsAllsVue.$data.groupCardsAlls = phoneFilterResult;
            // 原本的資料名稱＋$data+後面引入的新搜尋資料
        } else {
            alert(xhr.status);
        }
    }

    xhr.open("post", "groupViewFilterPhone.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    let data_info = `filter=${$('input[name=groupView_FliterPpl_phone]:checked').val()} ${$('input[name=groupView_FliterSex_phone]:checked').val()} ${$('input[name=groupView_FliterDay_phone]:checked').val()} ${$('input[name=groupView_FliterMonth_phone]:checked').val()}`;
    // 把搜尋內容丟到後端
    // 指令串接
    console.log(data_info); //檢查送出的指令
    xhr.send(data_info);
});