const path = require('path');
const fs = require('fs');
const revisionHash = require('rev-hash');

/**
 * Get the current environment.
 *
 * @param {string} defaultValue
 * @returns {string}
 */
function getEnv(defaultValue = 'development') {
	return process.env.BABEL_ENV || process.env.NODE_ENV || defaultValue;
}

/**
 * Get the version of a package.
 *
 * @param {string} name
 * @return {string}
 */
function getPackageVersion(name) {
	const { version } = require(name + '/package.json');

	return version;
}

/**
 * Get the version (i.e. short revision hash) of a file.
 *
 * @param {string} file
 * @return {string}
 */
function getFileVersion(file) {
	return revisionHash(fs.readFileSync(file));
}

/**
 * Get cache identifier for babel-loader that includes the .browserslistrc to make sure that changes in there are recognized immediately.
 *
 * @returns {string}
 */
function getCacheIdentifier() {
	return JSON.stringify({
		'env': getEnv(),
		'@babel/core': getPackageVersion('@babel/core'),
		'babel-loader': getPackageVersion('babel-loader'),
		'browserslistrc': getFileVersion(path.resolve(__dirname, '..', '.browserslistrc')),
		'babelrc': getFileVersion(path.resolve(__dirname, '..', '.babelrc')),
	});
}

module.exports = getCacheIdentifier;
