module.exports = {
	content: [
		'./DistributionPackages/Pn3uma.App/Resources/Private/Layouts/*.html',
		'./DistributionPackages/Pn3uma.App/Resources/Private/Templates/*/*.html',
		'./DistributionPackages/Pn3uma.App/Resources/Public/Scripts/main.js',
	],
	theme: {
		extend: {},
	},
	plugins: [
		require('@tailwindcss/forms'),
	],
}
