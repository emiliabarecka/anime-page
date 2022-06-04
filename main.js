const dane = fetch("http://anime_api/api/animes")
    .then(res => res.json())
    .then(data => {
        menuDiv = document.querySelector(".animeMenu");
        data.forEach((row, index)=>{
            console.log(row.description_0)
            const a = document.createElement('a');
            a.setAttribute("href", `http://anime_api/api/animes/${index+1}`)
            a.textContent = row.title;
            a.classList.add('dropdown-item')
            const dropDivider = document.createElement('div');
            dropDivider.classList.add('dropdown-divider');
            
            if(menuDiv){
                menuDiv.appendChild(a);
                menuDiv.appendChild(dropDivider);
            }
        })
    })
    

    let id = 2;

    const dane2 = fetch(`http://anime_api/api/animes/${id}`)
    .then(res => res.json())
    .then(data => {
            console.log(data.title)
        })
    