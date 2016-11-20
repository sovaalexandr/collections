<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\Common\Collections\Expr\Comparison;

use Doctrine\Common\Collections\Expr\ClosureExpressionVisitor;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Expr\Value;

/**
 * @author Yannick Voyer (http://github.com/yvoyer)
 */
final class GreaterThan extends Comparison
{
    /**
     * @param string $field
     * @param mixed|Value $value
     */
    public function __construct($field, $value)
    {
        parent::__construct($field, Comparison::GT, $value);
    }

    /**
     * @return callable
     */
    public function getFilterCallback()
    {
        return function ($object) {
            $value = $this->getValue()->getValue();
            return ClosureExpressionVisitor::getObjectFieldValue($object, $this->getField()) > $value;
        };
    }
}
