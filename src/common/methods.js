function revealContent(elementId) {
  if (document.getElementById(elementId).classList.contains('hidden')) {
    document.getElementById(elementId).classList.toggle('shown');
  }
}
