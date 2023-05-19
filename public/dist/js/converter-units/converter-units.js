function convertUnits(value, fromUnit, toUnit) {
    switch(fromUnit) {
        case 'm': valueInMeters = value; break;
        case 'cm': valueInMeters = value / 100; break;
        case 'mm': valueInMeters = value / 1000; break;
        case 'Km': valueInMeters = value * 1000; break;
        case 'Mm': valueInMeters = value * 1000000; break;
        case 'Gm': valueInMeters = value * 1000000000; break;
        case 'g': valueInGramms = value; break;
        case 'cg': valueInGramms = value / 100; break;
        case 'mg': valueInGramms = value / 1000; break;
        case 'ug': valueInGramms = value / 1000000; break;
        case 'ng': valueInGramms = value / 1000000000; break;
        case 'pg': valueInGramms = value / 1000000000000; break;
        case 'fg': valueInGramms = value / 1000000000000000; break;
        case 'Kg': valueInGramms = value * 1000; break;
        case 'Mg': valueInGramms = value * 1000000; break;
        case 'Gg': valueInGramms = value * 1000000000; break;
        case 'oz': valueInGramms = value * 28.35; break;
        case 'lb': valueInGramms = value * 453.59; break;
        // Agregar más casos según sea necesario
        default:
            throw new Error("Unidad '" + fromUnit + "' no es válida");
    }

    switch(toUnit) {
        case 'm': return valueInMeters;
        case 'cm': return valueInMeters * 100;
        case 'mm': return valueInMeters * 1000;
        case 'Km': return valueInMeters / 1000;
        case 'Mm': return valueInMeters / 1000000;
        case 'Gm': return valueInMeters / 1000000000;
        case 'g': return valueInGramms;
        case 'cg': return valueInGramms * 100;
        case 'mg': return valueInGramms * 1000;
        case 'ug': return valueInGramms * 1000000;
        case 'ng': return valueInGramms * 1000000000;
        case 'pg': return valueInGramms * 1000000000000;
        case 'fg': return valueInGramms * 1000000000000000;
        case 'Kg': return valueInGramms / 1000;
        case 'Mg': return valueInGramms / 1000000;
        case 'Gg': return valueInGramms / 1000000000;
        case 'oz': return valueInGramms / 28.35;
        case 'lb': return valueInGramms / 453.59;
        // Agregar más casos según sea necesario
        default:
            throw new Error("Unidad '" + toUnit + "' no es válida");
    }
}
