/* global base_url, Window, Tools */

Home = {
    initTabsBloc: function () {
        $('#tabs-home a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show')
        });
    },
};