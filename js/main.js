const artiCont = document.querySelectorAll('#article-container')

artiCont.forEach(arti => {
  arti.addEventListener('click', () => {
    const id = arti.getAttribute('data-articleId')
    window.location.href = `http://localhost/jayson/content.php?id=${id}`
  })
})
const queryString = window.location.search
const params = new URLSearchParams(queryString)
const id = params.get('token')

if (id == null) {
  document.querySelector('body').innerHTML =
    '<h1>Error: Bawal ka dito gago!</h1>'
}

async function accIsTrue () {
  try {
    const data = await fetch(`http://localhost:3000/api/${id}`)
    const res = await data.json()
    console.log(data.status)
    if (data.status != 200 || res.status == '') {
      document.querySelector('body').innerHTML = '<h1>Bawal ka dito gago!</h1>'
    }
  } catch (err) {
    console.log(err)
    document.querySelector('body').innerHTML =
      '<h1>Error: Bawal ka dito gago!</h1>'
  }
}
