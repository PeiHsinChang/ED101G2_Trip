window.onload = function() {
    let xhr = new XMLHttpRequest();

    xhr.onload = function() {
        if (xhr.status == 200) {
            groupSortLikeRows = JSON.parse(xhr.responseText);
            console.log(groupSortLikeRows[0]);

            //desktop version
            sortLike = groupSortLikeRows[0];
            new Vue({
                el: '#groupCardsAll',
                data: {
                    sortLike,
                },
                computed: {
                    sortbyLike: function() {
                        function compare(a, b) {
                            if (a.hostlike < b.hostlike)
                                return -1;
                            if (a.hostlike > b.hostlike)
                                return 1;
                            return 0;
                        }

                        return this.sortLike.sort(compare);
                    }
                }
            });

        } else {
            alert(xhr.status);
        }
    };
    xhr.open("post", "groupSortByLike.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send();
};