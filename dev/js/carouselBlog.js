window.onload = function () {
    titleCarouselBlog();
    blogCard();
}

function titleCarouselBlog() {
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
            BlogCarousel_As = carouselPackage[0];
            BlogCarousel_Bs = carouselPackage[1];
            BlogCarousel_Cs = carouselPackage[2];
            BlogCarousel_Ds = carouselPackage[3];
            BlogCarousel_Es = carouselPackage[4];

            //手機版輪播
            BlogCarousel_Fs = carouselPackage[0];
            BlogCarousel_Gs = carouselPackage[1];
            BlogCarousel_Hs = carouselPackage[2];
            BlogCarousel_Is = carouselPackage[3];
            BlogCarousel_Js = carouselPackage[4];
            //桌機版輪播
            new Vue({
                el: '#BlogCarousel_deskA',
                data: {
                    BlogCarousel_As,
                },
                computed: {

                },
            });
            new Vue({
                el: '#BlogCarousel_deskB',
                data: {
                    BlogCarousel_Bs,
                },
                computed: {

                },
            });
            new Vue({
                el: '#BlogCarousel_deskC',
                data: {
                    BlogCarousel_Cs,
                },
                computed: {

                },
            });
            new Vue({
                el: '#BlogCarousel_deskD',
                data: {
                    BlogCarousel_Ds,
                },
                computed: {},
            });
            new Vue({
                el: '#BlogCarousel_deskE',
                data: {
                    BlogCarousel_Es,
                },
                computed: {

                },
            });

            //手機版輪播
            new Vue({
                el: '#BlogCarousel_deskF',
                data: {
                    BlogCarousel_Fs,
                },

                computed: {

                },
            });
            new Vue({
                el: '#BlogCarousel_deskG',
                data: {
                    BlogCarousel_Gs,
                },
                computed: {

                },
            });
            new Vue({
                el: '#BlogCarousel_deskH',
                data: {
                    BlogCarousel_Hs,
                },
                computed: {

                },
            });
            new Vue({
                el: '#BlogCarousel_deskI',
                data: {
                    BlogCarousel_Is,
                },
                computed: {},
            });
            new Vue({
                el: '#BlogCarousel_deskJ',
                data: {
                    BlogCarousel_Js,
                },
                computed: {

                },



            });
        } else {
            alert(xhr.status);
            //如果資料傳送失敗的話顯示原因
        }
    };
    xhr.open("post", "BlogCarousel.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send(); //因為開太快所以要送個空值回去
};

function blogCard() {
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {

            //desktop version
            var blogviewCards = JSON.parse(xhr.responseText);
            console.log(blogviewCards[0]);
            blogCardsAlls = blogviewCards[0];

            blogCardsAllsVue = new Vue({
                el: '#blogCardsAll',
                data: {
                    blogCardsAlls,
                },

            });

        } else {
            alert(xhr.status);
        }
    };
    xhr.open("post", "blogCard.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send(null);
};

$("#blogSearch").click(function () {
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
            blogCardsAllsVue.$data.blogCardsAlls = searchResult;
            // 原本的資料名稱＋$data+後面引入的新搜尋資料
        } else {
            alert(xhr.status);
        }
    }

    xhr.open("post", "blogSearch.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    let data_info = `search_text=${$("#search_text").val()}`;
    // 把搜尋內容丟到後端
    xhr.send(data_info);
});

function SortByLike() {

    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {

            //desktop version
            var blogviewSortLike = JSON.parse(xhr.responseText);
            console.log(blogviewSortLike[0]);
            blogSortLike = blogviewSortLike[0];
            blogCardsAllsVue.$data.blogCardsAlls = blogSortLike;

        } else {
            alert(xhr.status);
        }
    };
    xhr.open("post", "blogSortByLike.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send();


};

function sortByLatest() {
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {

            //desktop version
            var blogviewSortLatest = JSON.parse(xhr.responseText);
            console.log(blogviewSortLatest[0]);
            blogSortLatest = blogviewSortLatest[0];
            blogCardsAllsVue.$data.blogCardsAlls = blogSortLatest;

        } else {
            alert(xhr.status);
        }
    };
    xhr.open("post", "blogSortByLatest.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send();
}