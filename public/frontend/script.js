document.getElementById('open-drawer-btn').addEventListener('click', function() {
    document.getElementById('drawer').style.width = '250px';
  });
  
  document.addEventListener('click', function(e) {
    if (e.target.id !== 'open-drawer-btn' && e.target.closest('.drawer') === null) {
      document.getElementById('drawer').style.width = '0';
    }
  });
  