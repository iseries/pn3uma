module.exports = {
	content: [
		'./DistributionPackages/Pn3uma.App/Resources/Private/Layouts/*.html',
		'./DistributionPackages/Pn3uma.App/Resources/Private/Templates/*/*.html',
	],
	theme: {
		extend: {},
	},
	plugins: [
		require('@tailwindcss/forms'),
	],
}
