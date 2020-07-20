function groupSearch() {
    //點開頁面就要load
    var xhr = new XMLHttpRequest();
    //發出ajax請求要資料
    xhr.onload = function () {
        if (xhr.status == 200) {
            //如果資料傳送成功
            searchResultPackage = JSON.parse(xhr.responseText);
            // console.log(searchResultPackage);
            searchResult = searchResultPackage;
            //把結果送到畫面上面
            //搜尋結果為零要寫到畫面上的v if 裡面
            new Vue({
                el: '#',
                data: {
                    searchResult,
                },
                computed: {
                    noResult() {
                        alert('目前沒有符合條件的團唷～');
                    }
                },
            });
        } else {
            alert(xhr.status);
            //如果資料傳送失敗的話顯示原因
        }
    };
    xhr.open("post", "groupSearch.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send(); //因為開太快所以要送個空值回去
};