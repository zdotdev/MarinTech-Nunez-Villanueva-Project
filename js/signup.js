const form = document.querySelector('form')
form.addEventListener('submit', async event => {
  event.preventDefault()
  const formData = new FormData(form)
  const data = Object.fromEntries(formData.entries())
  signup(data)
  console.log(data)
})

async function signup (formDat) {
  try {
    const data = await fetch('http://localhost:3000/api/signup', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(formDat)
    })
    const response = await data.json()
    console.log(response.status)
    document.getElementById('message-area').innerHTML = response.message
    if (response.status === 201) {
      window.location.href = `http://localhost/jayson/index.php?token=${response.id}`
    }
  } catch (err) {
    console.log(err)
  }
}
