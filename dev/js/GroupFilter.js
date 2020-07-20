// window.onload = function () {
//     titleCarouselBlog();
// }

// function groupFilter() {
//     //點開頁面就要load
//     var xhr = new XMLHttpRequest();
//     //發出ajax請求要資料
//     xhr.onload = function () {
//         if (xhr.status == 200) {
//             //如果資料傳送成功
//             groupviewCards = JSON.parse(xhr.responseText);
//             console.log(groupviewCards[0]);
//             groupCardsAlls = groupviewCards[0];
//             new Vue({
//                 el: '#groupCardsAll',
//                 data: {
//                     groupCardsAlls,
//                 },
//             });

//         } else {
//             alert(xhr.status);
//             //如果資料傳送失敗的話顯示原因
//         }
//     };
//     xhr.open("post", "groupViewFilter.php", true);
//     xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
//     xhr.send(); //因為開太快所以要送個空值回去
// };

$("#btnGroupFilter").click = function groupFilter() {
    //點開頁面就要load
    var xhr = new XMLHttpRequest();
    //發出ajax請求要資料
    xhr.onload = function () {
        if (xhr.status == 200) {
            groupviewCards = JSON.parse(xhr.responseText);
            // console.log(groupviewCards[0]);
            groupCards = groupviewCards[0];
            filter = new Vue({
                el: '#groupCardsAll',
                data: {
                    groupCards,
                },
            });



        } else {
            alert(xhr.status);
            //如果資料傳送失敗的話顯示原因
        }
    };
    xhr.open("post", "groupViewFilter.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send(); //因為開太快所以要送個空值回去
};