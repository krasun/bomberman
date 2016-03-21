<?php

namespace Bomberman\FieldCellInitializationAlgorithm;

use Bomberman\FieldCellInitializationAlgorithmInterface;

/**
 * Allows to chain initialization algorithms.
 */
class ChainInitializationAlgorithm implements FieldCellInitializationAlgorithmInterface
{
    /**
     * @var FieldCellInitializationAlgorithmInterface[]
     */
    private $initializationAlgorithms;

    /**
     * @param FieldCellInitializationAlgorithmInterface[] $initializationAlgorithms
     */
    public function __construct(array $initializationAlgorithms)
    {
        foreach ($initializationAlgorithms as $initializationAlgorithm) {
            $this->addInitializationAlgorithm($initializationAlgorithm);
        }
    }

    /**
     * @param FieldCellInitializationAlgorithmInterface $fieldCellInitializationAlgorithm
     *
     * @return ChainInitializationAlgorithm
     */
    private function addInitializationAlgorithm(FieldCellInitializationAlgorithmInterface $fieldCellInitializationAlgorithm)
    {
        $this->initializationAlgorithms[] = $fieldCellInitializationAlgorithm;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize($rowIndex, $columnIndex)
    {
        foreach ($this->initializationAlgorithms as $initializationAlgorithm) {
            $fieldObject = $initializationAlgorithm->initialize($rowIndex, $columnIndex);
            if ($fieldObject) {
                return $fieldObject;
            }
        }

        return null;
    }
}