<?php

namespace Selene\CMSBundle\Twig\Parser;

use Twig\Node\Node;

class ContentParser extends \Twig\TokenParser\AbstractTokenParser
{
    public function parse(\Twig\Token $token): Node
    {
        $parser = $this->parser;
        $stream = $parser->getStream();

        $name = $stream->expect(\Twig\Token::NAME_TYPE)->getValue();
        $stream->expect(\Twig\Token::OPERATOR_TYPE, '=');
        $value = $parser->getExpressionParser()->parseExpression();
        $stream->expect(\Twig\Token::BLOCK_END_TYPE);

        return new Project_Set_Node($name, $value, $token->getLine(), $this->getTag());
    }

    public function getTag(): string
    {
        return 'content';
    }
}
