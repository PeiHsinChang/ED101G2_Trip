window.onload = function() {
    let xhr = new XMLHttpRequest();
    xhr.onload = function() {
        if (xhr.status == 200) {
            groupviewCards = JSON.parse(xhr.responseText);
            console.log(groupviewCards[0]);

            //desktop version
            groupCardsAlls = groupviewCards[0];
            new Vue({
                el: '#groupCardsAll',
                data: {
                    groupCardsAlls,
                },
                computed: {
                    sortbyLike: function() {
                        function compare(a, b) {
                            if (a.hostlike < b.hostlike)
                            // console.log(a.hostlike);
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
    xhr.open("post", "groupCard.php", true);
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.send();
};