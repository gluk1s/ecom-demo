function scriptByPage(page) {
    if(page == "sitas"){
        console.log("sitas");
    }
    else if (page == "shop") {
        // convert str(json) to json
        let itemsJSON = [];
        items.forEach(element => {
            itemsJSON.push(JSON.parse(element));
        });
        let itemsMale = [];
        let itemsFemale = [];
        let itemsAccessories = [];

        // Make filtered arrays
        itemsJSON.forEach(item => {
            if (item["gender"] == "M") {
                itemsMale.push(item);
            }
            else if (item["gender"] == "F") {
                itemsFemale.push(item);
            }

            if (item["type"] == "accessories") {
                itemsAccessories.push(item);
            }
        });
        // All Products filter
        let resultAll = "";
        itemsJSON.forEach(item => {
            let tmpResult = 
            `<div class="col-lg-3 col-md-4 col-sm-6 item-container">
            <div class="item-image-container"><img class="item-image" src="./public/items/${item["img_dir1"]}"></div>
            <div class="item-text-container"><h5 class="item-name"><a class="item-name-link" href="${"/projects/final_project/items/" + item["id"]}">${item["name"]}</a></h5><h5 class="item-price">${item["price"]} $</h5></div>
            </div>`;
            resultAll += tmpResult;
        });
        // insert all items into HTML
        $("#filter-row").html(resultAll);

        // Create eventListeners for filter buttons
        let htmlResult = "";
        $("#allItems").click(function() {
            $(".filter-btn").removeClass("filter-btn-active");
            $(this).addClass("filter-btn-active");
            htmlResult = htmlFilteredItems(itemsJSON);
            $("#filter-row").html(htmlResult);
        });

        $("#womenItems").click(function() {
            $(".filter-btn").removeClass("filter-btn-active");
            $(this).addClass("filter-btn-active");
            htmlResult = htmlFilteredItems(itemsFemale);
            $("#filter-row").html(htmlResult);
        });

        $("#menItems").click(function() {
            $(".filter-btn").removeClass("filter-btn-active");
            $(this).addClass("filter-btn-active");
            htmlResult = htmlFilteredItems(itemsMale);
            $("#filter-row").html(htmlResult);
        });

        $("#accessoriesItems").click(function() {
            $(".filter-btn").removeClass("filter-btn-active");
            $(this).addClass("filter-btn-active");
            htmlResult = htmlFilteredItems(itemsAccessories);
            $("#filter-row").html(htmlResult);
        });
    }
    else if (page == "item") {
        $(".item-mini-photo").click(function() {
            $(".item-mini-photo").removeClass("mini-photo-active");
            $(this).addClass("mini-photo-active");
            let photo = $(this).html();
            console.log(photo);
            $("#big-item-photo").html(photo);
        })
    }
    else{
        console.log("ne sitas");
    }
}

function htmlFilteredItems(arrayOfItems) {
    let result = "";
    arrayOfItems.forEach(item => {
        let tmpResult = 
        `<div class="col-lg-3 col-md-4 col-sm-6 item-container">
        <div class="item-image-container"><img class="item-image" src="./public/items/${item["img_dir1"]}"></div>
        <div class="item-text-container"><h5 class="item-name"><a class="item-name-link" href="${"/projects/final_project/items/" + item["id"]}">${item["name"]}</a></h5><h5 class="item-price">${item["price"]} $</h5></div>
        </div>`;
        result += tmpResult;
    });
    return result;
}

