({
    appDir: "",
    baseUrl: "",
    dir: "../js-build",
	paths: {
		interface: "interface",
		vendor: "vendor",
		jquery: "empty:"
    },
 	keepBuildDir: true,
    modules: [
        {
            name: "main"
        }
    ],
	fileExclusionRegExp: /^\./
})