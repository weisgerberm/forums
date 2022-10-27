const path = require('path');
const fs = require('fs');

/**
 * Resolve the path to a SVG icon, searching in the site first, then in 'Global'.
 *
 * @see https://webpack.js.org/api/loaders/#thisresolve
 *
 * @param {string} context Directory that we're starting at (i.e. the directory with the source Sass file)
 * @param {string} request Resource to get (i.e. the name of the SVG file)
 * @param {function} callback Callback function to return data by
 */
function resolveSvgPath(context, request, callback) {
	// Get the root path for our work.
	const root = path.resolve(__dirname, '..', 'src/fileadmin/Resources');

	// Extract site name from context.
	const base = path.resolve(root, 'Source');
	const contextRelative = context.replace(base + '/', '');
	const site = path.parse(contextRelative).dir;

	// Build list of possible files.
	const possibleFiles = [site, 'Global'].map(site => {
		return path.resolve(root, 'Public', site, 'SVG', request);
	});

	// Walk through possible files and return the first one available.
	let found = false;
	possibleFiles.forEach(possibleFile => {
		try {
			fs.accessSync(possibleFile, fs.constants.R_OK);
			callback(null, possibleFile);
			found = true;

			return;
		} catch (err) {
			// Swallow the error.
		}
	});

	// Trigger an error if still here.
	if (!found) {
		callback('File ' + request + ' not found');
	}
}

module.exports = resolveSvgPath;
