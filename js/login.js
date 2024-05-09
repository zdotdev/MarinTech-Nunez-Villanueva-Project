const form = document.querySelector('form')
form.addEventListener('submit', async event => {
  event.preventDefault()
  const formData = new FormData(form)
  const data = Object.fromEntries(formData.entries())
  login(data)
})

async function login (formDat) {
  try {
    const data = await fetch('http://localhost:3000/api/login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(formDat)
    })
    const response = await data.json()
    document.getElementById('message-area').innerHTML = response.message
    if (data.status === 200) {
      window.location.href = `http://localhost/jayson/index.php?token=${response.id}`
    }
  } catch (err) {
    console.log(err)
  }
}
