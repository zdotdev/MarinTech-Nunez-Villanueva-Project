const artiCont = document.querySelectorAll('#article-container')

artiCont.forEach(arti => {
  arti.addEventListener('click', () => {
    const id = arti.getAttribute('data-articleId')
    window.location.href = `http://localhost/jayson/content.php?id=${id}`
  })
})
