export default {
    init: function() {

        // Return if there's less than 2 tabs
        if(document.querySelectorAll('.tab').length < 2){
            return;
        };

        const tabs = document.querySelectorAll('.tab');
        
        tabs.forEach(tab => {

            const id = tab.dataset.targetId;

            tab.addEventListener('click', function(e){    
                // Remove active class and aria-current from all tabs
                tabs.forEach( (tab) => {
                    tab.classList.remove('active');
                    tab.removeAttribute('aria-current');
                    tab.setAttribute('tabindex', -1);
                });
   
                // Add active class to clicked tab and set aria-current
                tab.classList.add('active');
                tab.setAttribute('aria-current', 'true');
                tab.setAttribute('tabindex', 0);

                // Hide all tab panes
                const tabPane = document.querySelectorAll('.tab-pane');
                tabPane.forEach(pane => {
                    pane.classList.remove('active');
                    pane.classList.add('hidden');
                });

                // Show clicked tab content
                const tabPaneToShow = document.getElementById(id);
                tabPaneToShow.classList.add('active');
                tabPaneToShow.classList.remove('hidden');

            });
        });
    }
};
