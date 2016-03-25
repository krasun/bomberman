function renderFieldCell(fieldCell) {
    var fieldCellElement = document.createElement('div');
    fieldCellElement.setAttribute('data-row-index', fieldCell.rowIndex);
    fieldCellElement.setAttribute('data-column-index', fieldCell.columnIndex);
    fieldCellElement.className += 'field-cell ' + (fieldCell.fieldObject ? fieldCell.fieldObject.className : 'Empty')

    return fieldCellElement;
}

function renderField(field) {
    var fieldElement = document.createElement('div');
    fieldElement.className += 'field';

    for (var rowIndex = 0; rowIndex < field.cells.length; rowIndex++) {
        var fieldRow = document.createElement('div');
        fieldRow.className += 'field-row';

        for (var columnIndex = 0; columnIndex < field.cells[rowIndex].length; columnIndex++) {
            fieldRow.appendChild(renderFieldCell(field.cells[rowIndex][columnIndex]))
        }

        fieldElement.appendChild(fieldRow);
    }

    return fieldElement;
}

function renderGame(fieldContainer, gameState) {
    if (fieldContainer.hasChildNodes()) {
        fieldContainer.removeChild(fieldContainer.firstChild);
    }

    fieldContainer.appendChild(renderField(gameState.field));
}

