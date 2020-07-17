window.onload = function() {
    let xhr = new XMLHttpRequest();

    xhr.onload = function() {
        if (xhr.status == 200) {
            groupSortLikeRows = JSON.parse(xhr.responseText);
            console.log(groupSortLikeRows[0]);

            //desktop version
            groupCardsAlls = groupSortLikeRows[0];
            new Vue({
                el: '#groupCardsAll',
                data: {
                    groupCardsAlls,
                },
                computed: {
                    sortedArray: function() {
                        function compare(a, b) {
                            if (a.hostlike < b.hostlike)
                                return -1;
                            if (a.hostlike > b.hostlike)
                                return 1;
                            return 0;
                        }

                        return this.groupCardsAlls.sort(compare);
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