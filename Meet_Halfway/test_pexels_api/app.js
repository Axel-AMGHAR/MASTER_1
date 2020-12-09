let city = undefined;

const cl = e => console.log(e);

async function get_city(){
    await fetch('https://api.pexels.com/v1/search?query=valence&per_page=1',{
        method: 'get',
        headers: new Headers({
            'Authorization': '563492ad6f91700001000001a089d72b88ba4393acaa7d770b916f17'
        })
    }).then(res => res.json())
        .then(res => {cl(res); city = res})

    cl(city.photos)
}

async function get_test(){
    let test = undefined;
    await fetch('https://api.pexels.com/v1/curated',{
        method: 'get',
        headers: new Headers({
            'Authorization': '563492ad6f91700001000001a089d72b88ba4393acaa7d770b916f17'
        })
    }).then(res => res.json())
        .then(res => test = res)

    cl(test)
}

async function get_photo_with_place_api(){

    /** With proxyurl*/
    const proxyurl = "https://cors-anywhere.herokuapp.com/";
    const url = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?key=AIzaSyBy8rf010Rol84bXYjyF0UqIQZrVeNfzZs&location=49.246292,-123.116226&radius=500000"; // site that doesn’t send Access-Control-*
    fetch(proxyurl + url) // https://cors-anywhere.herokuapp.com/https://example.com
        .then(response => response.json())
        .then(contents => console.log(contents))
        .catch(() => console.log("Can’t access " + url + " response. Blocked by browser?"))
    /** With AJAX*/
/*    $.ajax({
        url: 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?key=AIzaSyBy8rf010Rol84bXYjyF0UqIQZrVeNfzZs&location=49.246292,-123.116226&radius=500000',
        type: "GET",
        dataType: 'jsonp',
        cache: false,
        success: function(response){
            cl('test')
            cl(response);
        },
        error: function(error){
            cl('error')
            cl(error);
        }
    });*/
    let photo_reference;

    /** Conventional test */
/*        await fetch('https://maps.googleapis.com/maps/api/place/nearbysearch/json?key=AIzaSyBy8rf010Rol84bXYjyF0UqIQZrVeNfzZs&location=49.246292,-123.116226&radius=500000',
            {
                method: 'get',
                dataType: 'jsonp'
            })
            .then((resp) => {
                resp.json();
            })
            .then((data) => {
                console.log(data);
            });*/
    /*

        await fetch('https://maps.googleapis.com/maps/api/place/findplacefromtext/json?input=paris,' +
            ' IL&key=AIzaSyBy8rf010Rol84bXYjyF0UqIQZrVeNfzZs&inputtype=textquery&fields=name,photos',{
            method: 'get',
            dataType: 'jsonp',
    /!*        headers: new Headers({
                'Authorization': '563492ad6f91700001000001a089d72b88ba4393acaa7d770b916f17'
            })*!/
        }).then(res => res.json())
            .then(res => photo_reference = res);
    */

    cl('phot ref')
    cl(photo_reference)

    /*    await fetch('https://maps.googleapis.com/maps/api/place/photo',{
            method: 'get',
            body: JSON.stringify({
                photoreference: ,
                key: 'AIzaSyBy8rf010Rol84bXYjyF0UqIQZrVeNfzZs',
                maxwidth: 400,
                maxheight: 400
            })
        }).then(res => res.json())
            .then(res => test = res)
        /!* Get photo reference *!/
        cl(test)*/
}

async function get_photos_with_sygic_api(){
    let response;
    /** With proxyurl*/
    const proxyurl = "https://cors-anywhere.herokuapp.com/";
    const url = "https://api.sygictravelapi.com/1.0/en/places/list?query=eiffel"; // site that doesn’t send Access-Control-*
    fetch(proxyurl + url, {
        method: 'GET',
        headers: new Headers({
            'x-api-key': 'fjMWfKttyA4tkMZQnXdHe3K'
        })
    }) // https://cors-anywhere.herokuapp.com/https://example.com
        .then(response => response.json())
        .then(contents => console.log(contents))
        .catch(() => console.log("Can’t access " + url + " response. Blocked by browser?"))

/*    await fetch('https://api.sygictravelapi.com/1.0/en/places/list?query=eiffel',{
        method: 'get',
    }).then(res => res.json())
        .then(res => response = res)
        .catch(err => cl(err));*/
    cl(response);
}

/** Allow us to retrive photos from wiki Media */
/* What is wrong
* => don't have same format
* => sometimes return a panel photo with multiples photos
* => sometimes there is no photo associated with the city (ex Valence France) */

/* To try => see what parameter i can use in the query */

 function get_photos_with_wikipedia_api(){
    let response;

    let cities = ['Paris', 'Marseille', 'Nice', 'Strasbourg', 'Bordeaux', 'Lille', 'Lyon', 'Montpellier', 'Toulouse', 'Nantes']
      cities.forEach(async city => {
        await fetch('https://fr.wikipedia.org/w/api.php?action=query&prop=pageimages&format=json&piprop=original&titles='+ city + '&origin=*',{
            method: 'get',
        }).then(res => res.json())
            .then(res => response = res)
            .catch(err => cl(err));

        cl(response.query)
        /* Get image of a research */
        let link_photo = Object.keys(response.query.pages).filter((key, index) => index === 0 ).map(key => response.query.pages[key]['original']['source'])[0];

        $('.test')
            .append($('<h3/>').html(city))
            .append($('<img/>', {'src': link_photo}))
    });

}

async function get_photos_with_depositos_photos_api(){
    let response;

/*    let cities = ['Paris', 'Marseille', 'Nice', 'Strasbourg', 'Bordeaux', 'Lille', 'Lyon', 'Montpellier', 'Toulouse', 'Nantes']
    cities.forEach(async city => {*/
        await fetch('http://api.depositphotos.com?dp_apikey=f3c379612ceaa9a5c3836f38403c394aa3469d6b&dp_command=search&dp_search_query=Lille France'
        ).then(res => res.json())
            .then(res => response = res)
            .catch(err => cl(err));

        cl(response)
/*
    $('.test').append($('<img/>', {'src': response}
*/
/*        /!* Get image of a research *!/
        let link_photo = Object.keys(response.query.pages).filter((key, index) => index === 0 ).map(key => response.query.pages[key]['original']['source'])[0];

        $('.test')
            .append($('<h3/>').html(city))
            .append($('<img/>', {'src': link_photo}))
    });*/

}

/* TODO
*   Crop photo
*   foreach city
*   get the list code and call ftech , return the url of the image
*   save in base everytime there is a new code city
*   if the city code exist, don't fetch, but show the url
* */
function get_photos_with_wikidata(){
    let response;

    const proxyurl = "https://cors-anywhere.herokuapp.com/";
    let cities = ['Q90', 'Q8848', 'Q456','Q175081' /*, 'Marseille', 'Nice', 'Strasbourg', 'Bordeaux', 'Lille', 'Lyon', 'Montpellier', 'Toulouse', 'Nantes'*/]
    let cities_name = ['paris', 'valence', 'lyon','gap'];
        cities.forEach(async (city, index) => {
        await fetch(proxyurl +'https://www.wikidata.org/w/api.php?format=json&action=wbgetclaims&property=P18&entity='+ city)
            .then(res => res.json())
            .then(res => response = res)
            .catch(err => cl(err));
        /* Get image of a research */
            cl(response)
        let photo = response.claims.P18[0].mainsnak.datavalue.value

/*        let link_photo = Object.keys(response['claims'])
            .filter((key, index) => index === 0 ).map(key => response['claims'][key][0]['mainsnak'])[0];*/
/*
        let link_photo = Object.keys(response.query.pages).filter((key, index) => index === 0 ).map(key => response.query.pages[key]['original']['source'])[0];
*/

        $('.test')
            .append($('<h3/>').html(cities_name[index]))
            .append($('<img/>', {
                src:'https://commons.wikimedia.org/wiki/Special:FilePath/'+ photo +'?width=320 320w',
                style: 'background-size: cover;'}))
    });

}

get_photos_with_wikidata();