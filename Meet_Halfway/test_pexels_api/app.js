let city = undefined;

const cl = e => console.log(e);

async function get_city(){
    await fetch('https://api.pexels.com/v1/search?query=lyon&per_page=1',{ 
        method: 'get', 
        headers: new Headers({
            'Authorization': '563492ad6f91700001000001a089d72b88ba4393acaa7d770b916f17'
        })
    }).then(res => res.json())
        .then(res => city = res)

    cl(city.photos[0].src.small)
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


get_city()
get_test()
