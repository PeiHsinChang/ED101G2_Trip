window.onload = function() {
    let xhr = new XMLHttpRequest();

    xhr.onload = function() {
        if (xhr.status == 200) {
            groupSortLikeRows = JSON.parse(xhr.responseText);
            console.log(groupSortLikeRows[0]);

            //desktop version
            groupSorts = groupSortLikeRows[0];
            new Vue({
                el: '#groupCardsAll',
                data: {
                    groupSorts,
                },
            });

        } else {
            alert(xhr.status);
        }
    };
    xhr.open("post", "groupSortByLike.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send();
};