<template>
	
</template>

<script type="text/javascript">
	export default {
		data: () => ({
            drawer: null,
            item: 1,
          	items: [
            	{ text: 'Real-Time', icon: 'mdi-clock' },
            	{ text: 'Audience', icon: 'mdi-account' },
            	{ text: 'Conversions', icon: 'mdi-flag' },
          	],
            breadcrumbs: [
                {
                    text: 'Dashboard',
                    disabled: false,
                    href: 'breadcrumbs_dashboard',
                },
                {
                    text: 'Link 1',
                    disabled: false,
                    href: 'breadcrumbs_link_1',
                },
                {
                    text: 'Link 2',
                    disabled: true,
                    href: 'breadcrumbs_link_2',
                },
            ],
            admins: [
                ['Management', 'mdi-account-multiple-outline'],
                ['Settings', 'mdi-cog-outline'],
            ],
        }),
	}
</script>