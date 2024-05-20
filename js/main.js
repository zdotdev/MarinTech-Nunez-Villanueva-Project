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
    const id = 'someId' // Ensure 'id' is defined and has a value
    const response = await fetch(`http://localhost:3000/api/${id}`)

    // Check if the request was successful
    if (!response.ok) {
      throw new Error(`HTTP error status: ${response.status}`)
    }

    const data = await response.json()
    console.log(response.status) // Log the status of the HTTP response
    // Assuming you want to do something with the data
    // For example, display it in the body
    document.querySelector('body').textContent = JSON.stringify(data) // Display the data as a string
  } catch (err) {
    console.log(err)
    document.querySelector('body').textContent =
      '<h1>Error: Bawal ka dito gago!</h1>' // Display an error message
  }
}

accIsTrue()
