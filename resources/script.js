document.addEventListener('DOMContentLoaded', () => {
  // DOM elements
  const notifications = document.querySelectorAll('.notification')
  const toggleButton = document.getElementById('toggle-news-list')
  const arrowIcon = document.getElementById('arrow-icon')
  const newsList = document.querySelector('.news-list')
  const editButtons = document.querySelectorAll('.edit-btn')
  const cancelBtn = document.getElementById('cancel-btn')
  const saveBtn = document.getElementById('save-btn')
  const formTitle = document.getElementById('form-title')
  const newsIdField = document.getElementById('news-id')
  const newsTitleField = document.getElementById('news-title')
  const newsDescriptionField = document.getElementById('news-description')

  // Event listeners
  toggleButton.addEventListener('click', toggleNewsList)
  editButtons.forEach(button =>
    button.addEventListener('click', handleEditButtonClick)
  )
  cancelBtn.addEventListener('click', handleCancelButtonClick)

  // Methods
  function toggleNewsList() {
    const isHidden = newsList.style.display === 'none'
    newsList.style.display = isHidden ? 'block' : 'none'
    arrowIcon.classList.toggle('arrow-open-icon', isHidden)
    arrowIcon.classList.toggle('arrow-close-icon', !isHidden)
  }

  function handleEditButtonClick(event) {
    const button = event.currentTarget
    const id = button.getAttribute('data-id')
    const title = button.getAttribute('data-title')
    const description = button.getAttribute('data-description')

    // Set values in form fields
    setFormFields(id, title, description)

    // Change form title and button text
    updateFormMode('Edit News', 'save_news', 'Save')
    cancelBtn.classList.remove('hidden')
  }

  function handleCancelButtonClick() {
    // Clear form fields
    setFormFields('', '', '')

    // Change form title and button text
    updateFormMode('Create News', 'create_news', 'Create')
    cancelBtn.classList.add('hidden')
  }

  function setFormFields(id, title, description) {
    newsIdField.value = id
    newsTitleField.value = title
    newsDescriptionField.value = description
  }

  function updateFormMode(title, buttonName, buttonValue) {
    formTitle.textContent = title
    saveBtn.name = buttonName
    saveBtn.value = buttonValue
  }
})
