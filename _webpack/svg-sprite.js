const path = require('path');
const fs = require('fs');
const globby = require('globby');
const svgSprite = require('svg-sprite');

// Get list of sites.
const sites = require('../package').sites;

// Set configuration for sprites.
const config = {
	mode: {
		symbol: true
	}
};

// Create SVG sprite for every site.
sites.forEach(async (site) => {
	// Create spriter instance.
	const svgSpriter = svgSprite(config);

	// Compose pattern for globbing.
	const patterns = ['Global', site].map((folder) => {
		return '.' + path.join('/src/fileadmin/Resources/Public', folder, 'SVG', '*.svg'); // Note the added '.' as we need a relative path.
	});

	// Now search files and add them to the sprite.
	const paths = await globby(patterns);
	paths.forEach((path) => {
		svgSpriter.add(path, null, fs.readFileSync(path, { encoding: 'utf-8' }));
	});

	// Compile the sprite.
	svgSpriter.compile((error, result) => {
		for (let mode in result) {
			for (let resource in result[mode]) {
				fs.writeFileSync('.' + path.join('/src/fileadmin/Resources/Public', site, 'Icons', 'sprite.svg'), result[mode][resource].contents);
			}
		}
	});
});
