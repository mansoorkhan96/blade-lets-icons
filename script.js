const fs = require("fs");
const { parseIconSet, iconToSVG } = require("@iconify/utils");

const source = "node_modules/@iconify-json/lets-icons/icons.json";
const target = "resources/svg";

const iconSet = JSON.parse(fs.readFileSync(source, "utf8"));

try {
    fs.mkdirSync(target, { recursive: true });
} catch (err) {
    console.error("Error creating directory:", err);
}

parseIconSet(iconSet, (name, data) => {
    if (!data) {
        return;
    }

    const renderData = iconToSVG(data, {
        height: "auto",
    });

    const svgAttributes = {
        xmlns: "http://www.w3.org/2000/svg",
        viewBox: '0 0 24 24'
    };

    const svgAttributesStr = Object.keys(svgAttributes)
        .map((attr) => `${attr}="${svgAttributes[attr]}"`)
        .join(" ");

    const svg = `<svg ${svgAttributesStr}>${renderData.body}</svg>`;

    const filename = `${target}/${name}.svg`;
    fs.writeFileSync(filename, svg, 'utf8');

    console.log('Written:', filename);
});
