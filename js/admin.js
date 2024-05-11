const articont = document.querySelectorAll('#article-container')
articont.forEach(item => {
  const id = item.getAttribute('data-articleId')
  item.querySelector('#edit-button').addEventListener('click', function () {
    document.getElementById(`edit-dialog-${id}`).showModal()
  })
})
